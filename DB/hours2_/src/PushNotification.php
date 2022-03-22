<?php

namespace PHPMaker2022\project1;

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

/**
 * Push Notification class
 */
class PushNotification
{

    public function subscribe()
    {
        return $this->addSubscription($_POST);
    }

    public function send()
    {
        global $Language, $TokenNameKey, $TokenValueKey;
        $payload = $_POST; // Get all post data
        if ($TokenNameKey && isset($payload[$TokenNameKey])) { // Remove Token Name
            unset($payload[$TokenNameKey]);
        }
        if ($TokenValueKey && isset($payload[$TokenValueKey])) { // Remove Token Key
            unset($payload[$TokenValueKey]);
        }
        $tbl = Container(Config("SUBSCRIPTION_TABLE_VAR"));
        $filter = "";
        $keys = Param("key_m", []);
        if (count($keys) > 0) {
            $filter = QuotedName(Config("SUBSCRIPTION_FIELD_NAME_ID"), Config("SUBSCRIPTION_DBID")) . " IN (" . implode(", ", $keys) . ")";
        }
        $rows = $tbl->loadRs($filter)->fetchAllAssociative();
        if (count($rows) == 0) {
            WriteJson([]);
            return false;
        }
        if (Config("SEND_PUSH_NOTIFICATION_TIME_LIMIT") >= 0) {
            @set_time_limit(Config("SEND_PUSH_NOTIFICATION_TIME_LIMIT")); // Set time limit for sending push notification
        }
        $subscriptions = [];
        foreach ($rows as $row) {
            if (count($row) > 0) {
                $subscriptions[] = Subscription::create([
                    "endpoint" => $row[Config("SUBSCRIPTION_FIELD_NAME_ENDPOINT")],
                    "publicKey" => $row[Config("SUBSCRIPTION_FIELD_NAME_PUBLIC_KEY")],
                    "authToken" => $row[Config("SUBSCRIPTION_FIELD_NAME_AUTH_TOKEN")],
                    "contentEncoding" => $row[Config("SUBSCRIPTION_FIELD_NAME_CONTENT_ENCODING")]
                ]);
            }
        }
        return $this->sendNotifications($subscriptions, $payload);
    }

    public function delete()
    {
        return $this->deleteSubscription($_POST);
    }

    protected function addSubscription($subscription)
    {
        $user = CurrentUserID() ?? CurrentUserName();
        $endpoint = $subscription["endpoint"] ?? "";
        $publicKey = $subscription["publicKey"] ?? "";
        $authToken = $subscription["authToken"] ?? "";
        $contentEncoding = $subscription["contentEncoding"] ?? "";
        if (
            EmptyString(Config("SUBSCRIPTION_TABLE_VAR")) ||
            EmptyString(Config("SUBSCRIPTION_FIELD_NAME_USER")) ||
            EmptyString(Config("SUBSCRIPTION_FIELD_NAME_ENDPOINT")) ||
            EmptyString(Config("SUBSCRIPTION_FIELD_NAME_PUBLIC_KEY")) ||
            EmptyString(Config("SUBSCRIPTION_FIELD_NAME_AUTH_TOKEN")) ||
            EmptyString(Config("SUBSCRIPTION_FIELD_NAME_CONTENT_ENCODING")) ||
            EmptyString($endpoint) ||
            EmptyString($publicKey) ||
            EmptyString($authToken) ||
            EmptyString($contentEncoding)
        ) {
            return false;
        }
        $rsnew = [
            Config("SUBSCRIPTION_FIELD_NAME_USER") => $user,
            Config("SUBSCRIPTION_FIELD_NAME_ENDPOINT") => $endpoint,
            Config("SUBSCRIPTION_FIELD_NAME_PUBLIC_KEY") => $publicKey,
            Config("SUBSCRIPTION_FIELD_NAME_AUTH_TOKEN") => $authToken,
            Config("SUBSCRIPTION_FIELD_NAME_CONTENT_ENCODING") => $contentEncoding
        ];

        // Insert subscription
        $addSubscription = true;
        $tbl = Container(Config("SUBSCRIPTION_TABLE_VAR"));
        if (method_exists($tbl, "rowInserting")) {
            $addSubscription = $tbl->rowInserting(null, $rsnew);
        }
        if ($addSubscription) {
            $addSubscription = $tbl->insert($rsnew);
            if ($addSubscription && method_exists($tbl, "rowInserted")) {
                $tbl->rowInserted(null, $rsnew);
            }
        }
        WriteJson(["success" => $addSubscription]);
    }

    /**
     * Send Notifications
     *
     * @param array $subscriptions Array of Subscription
     * @param mixed $payload Payload, see https://developer.mozilla.org/en-US/docs/Mozilla/Add-ons/WebExtensions/API/notifications/NotificationOptions
     * @return void
     */
    protected function sendNotifications($subscriptions, $payload)
    {
        global $Language;
        $auth = [
            "VAPID" => [
                "subject" => ConvertToUtf8($payload["title"] ?? $Language->phrase("PushNotificationDefaultTitle")),
                "publicKey" => Config("PUSH_SERVER_PUBLIC_KEY"),
                "privateKey" => Config("PUSH_SERVER_PRIVATE_KEY"),
            ],
        ];
        $webPush = new WebPush($auth);
        $notifications = array_map(function ($subscription) use ($payload) {
            $options = $payload; // Clone
            return ["subscription" => $subscription, "payload" => $options];
        }, $subscriptions);

        // Send multiple notifications with payload
        foreach ($notifications as $notification) {
            $webPush->queueNotification(
                $notification["subscription"],
                json_encode(ConvertToUtf8($notification["payload"]))
            );
        }

        // Check sent results
        $reports = [];
        foreach ($webPush->flush() as $report) { // $webPush->flush() returns Generator
            $reports[] = $report->jsonSerialize();
        }
        if (Config("DEBUG")) {
            Log(json_encode($reports));
            $results = $reports;
        } else {
            $results = array_map(function ($report) {
                return ["success" => $report["success"]]; // Return "success" only
            }, $reports);
        }
        WriteJson($results);
    }

    protected function deleteSubscription($subscription)
    {
        $user = CurrentUserID() ?? CurrentUserName();
        $endpoint = $subscription["endpoint"] ?? "";
        $publicKey = $subscription["publicKey"] ?? "";
        $authToken = $subscription["authToken"] ?? "";
        $contentEncoding = $subscription["contentEncoding"] ?? "";
        if (
            EmptyString(Config("SUBSCRIPTION_TABLE_VAR")) ||
            EmptyString(Config("SUBSCRIPTION_FIELD_NAME_USER")) ||
            EmptyString(Config("SUBSCRIPTION_FIELD_NAME_ENDPOINT")) ||
            EmptyString(Config("SUBSCRIPTION_FIELD_NAME_PUBLIC_KEY")) ||
            EmptyString(Config("SUBSCRIPTION_FIELD_NAME_AUTH_TOKEN")) ||
            EmptyString(Config("SUBSCRIPTION_FIELD_NAME_CONTENT_ENCODING"))
        ) {
            WriteJson(["success" => false, "error" => "Invalid subscription table settings"]);
            return;
        }
        if (
            EmptyString($endpoint) ||
            EmptyString($publicKey) ||
            EmptyString($authToken) ||
            EmptyString($contentEncoding)
        ) {
            WriteJson(["success" => false, "error" => "Invalid subscription"]);
            return;
        }
        $rsold = [
            Config("SUBSCRIPTION_FIELD_NAME_USER") => $user,
            Config("SUBSCRIPTION_FIELD_NAME_ENDPOINT") => $endpoint,
            Config("SUBSCRIPTION_FIELD_NAME_PUBLIC_KEY") => $publicKey,
            Config("SUBSCRIPTION_FIELD_NAME_AUTH_TOKEN") => $authToken,
            Config("SUBSCRIPTION_FIELD_NAME_CONTENT_ENCODING") => $contentEncoding
        ];
        // Delete subscription
        $deleteSubscription = true;
        $tbl = Container(Config("SUBSCRIPTION_TABLE_VAR"));
        $endpointField = $tbl->Fields(Config("SUBSCRIPTION_FIELD_NAME_ENDPOINT"));
        $filter = $endpointField ? $endpointField->Expression . "=" . QuotedValue($endpoint, $endpointField->DataType, $tbl->Dbid) : "";
        if ($filter && (int)$tbl->getConnection()->fetchOne("SELECT COUNT(*) FROM " . Config("SUBSCRIPTION_TABLE") . " WHERE " . $filter) === 0) { // Subscription not exists
            WriteJson(["success" => true]);
            return;
        }
        if (method_exists($tbl, "rowDeleting")) {
            $deleteSubscription = $tbl->rowDeleting($rsold);
        }
        if ($deleteSubscription) {
            if ($filter) {
                $deleteSubscription = $tbl->delete($rsold, $filter);
                if ($deleteSubscription && method_exists($tbl, "rowDeleted")) {
                    $tbl->rowDeleted($rsold);
                }
            } else {
                $deleteSubscription = false;
            }
        }
        WriteJson(["success" => $deleteSubscription]);
    }
}

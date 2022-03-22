<?php

namespace PHPMaker2022\mealplans;

/**
 * User Profile Class
 */
class UserProfile
{
    public $Username = "";
    public $Profile = [];
    public $Provider = "";
    public $Auth = "";
    protected $BackupUsername = "";
    protected $BackupProfile = [];
    protected $Excluded = []; // Excluded data (not to be saved to database)

    // Constructor
    public function __construct()
    {
        $this->load();
    }

    // Has value
    public function has($name)
    {
        return array_key_exists($name, $this->Profile);
    }

    // Get value
    public function getValue($name)
    {
        return $this->Profile[$name] ?? null;
    }

    // Get all values
    public function getValues()
    {
        return $this->Profile;
    }

    // Get value (alias)
    public function get($name)
    {
        return $this->getValue($name);
    }

    // Set value
    public function setValue($name, $value)
    {
        $this->Profile[$name] = $value;
    }

    // Set value (alias)
    public function set($name, $value)
    {
        $this->setValue($name, $value);
    }

    // Set property // PHP
    public function __set($name, $value)
    {
        $this->setValue($name, $value);
    }

    // Get property // PHP
    public function __get($name)
    {
        return $this->getValue($name);
    }

    // Delete property
    public function delete($name)
    {
        if (array_key_exists($name, $this->Profile)) {
            unset($this->Profile[$name]);
        }
    }

    // Assign properties
    public function assign($input, $save = true)
    {
        if (is_array($input) && !$save) {
            $this->Excluded = array_merge($this->Excluded, $input);
        }
        if (is_object($input)) {
            $this->assign(get_object_vars($input), $save);
        } elseif (is_array($input)) {
            foreach ($input as $key => $value) { // Remove integer keys
                if (is_int($key)) {
                    unset($input[$key]);
                }
            }
            $input = array_filter($input, function ($val) {
                if (is_bool($val) || is_float($val) || is_int($val) || $val === null || is_string($val) && strlen($val) <= Config("DATA_STRING_MAX_LENGTH")) {
                    return true;
                }
                return false;
            });
            $this->Profile = array_merge($this->Profile, $input);
        }
    }

    // Check if System Admin
    protected function isSystemAdmin($usr)
    {
        global $Language;
        $adminUserName = Config("ENCRYPTION_ENABLED") ? PhpDecrypt(Config("ADMIN_USER_NAME")) : Config("ADMIN_USER_NAME");
        return $usr == "" || $usr == $adminUserName || $usr == $Language->phrase("UserAdministrator");
    }

    // Backup user profile if user is different from existing user
    protected function backup($usr)
    {
        if ($this->Username != "" && $usr != $this->Username) {
            $this->BackupUsername = $this->Username;
            $this->BackupProfile = $this->Profile;
        }
    }

    // Restore user profile if user is different from backup user
    protected function restore($usr)
    {
        if ($this->BackupUsername != "" && $usr != $this->BackupUsername) {
            $this->Username = $this->BackupUsername;
            $this->Profile = $this->BackupProfile;
        }
    }

    // Get language id
    public function getLanguageId($usr)
    {
        try {
            if ($this->loadProfileFromDatabase($usr)) {
                return $this->get(Config("USER_PROFILE_LANGUAGE_ID"));
            }
        } catch (\Throwable $e) {
            if (Config("DEBUG")) {
                throw $e;
            }
        } finally {
            $this->restore($usr); // Restore current profile
        }
        return "";
    }

    // Set language id
    public function setLanguageId($usr, $langid)
    {
        try {
            if ($this->loadProfileFromDatabase($usr)) {
                $this->set(Config("USER_PROFILE_LANGUAGE_ID"), $langid);
                return $this->saveProfileToDatabase($usr);
            }
        } catch (\Throwable $e) {
            if (Config("DEBUG")) {
                throw $e;
            }
        } finally {
            $this->restore($usr); // Restore current profile
        }
        return false;
    }

    // Get search filters
    public function getSearchFilters($usr, $pageid)
    {
        try {
            if ($this->loadProfileFromDatabase($usr)) {
                $allfilters = @unserialize($this->get(Config("USER_PROFILE_SEARCH_FILTERS")));
                return @$allfilters[$pageid];
            }
        } catch (\Throwable $e) {
            if (Config("DEBUG")) {
                throw $e;
            }
        } finally {
            $this->restore($usr); // Restore current profile
        }
        return "";
    }

    // Set search filters
    public function setSearchFilters($usr, $pageid, $filters)
    {
        try {
            if ($this->loadProfileFromDatabase($usr)) {
                $allfilters = @unserialize($this->get(Config("USER_PROFILE_SEARCH_FILTERS")));
                if (!is_array($allfilters)) {
                    $allfilters = [];
                }
                $allfilters[$pageid] = $filters;
                $this->set(Config("USER_PROFILE_SEARCH_FILTERS"), serialize($allfilters));
                return $this->saveProfileToDatabase($usr);
            }
        } catch (\Throwable $e) {
            if (Config("DEBUG")) {
                throw $e;
            }
        } finally {
            $this->restore($usr); // Restore current profile
        }
        return false;
    }

    // Load profile from database
    public function loadProfileFromDatabase($usr)
    {
        return !$this->isSystemAdmin($usr); // Ignore system admin
    }

    // Save profile to database
    public function saveProfileToDatabase($usr)
    {
        return !$this->isSystemAdmin($usr); // Ignore system admin
    }

    // Load profile from session
    public function load()
    {
        if (isset($_SESSION[SESSION_USER_PROFILE])) {
            $this->loadProfile($_SESSION[SESSION_USER_PROFILE]);
        }
    }

    // Save profile to session
    public function save()
    {
        $_SESSION[SESSION_USER_PROFILE] = $this->profileToString();
    }

    // Load profile from string
    protected function loadProfile($profile)
    {
        $ar = unserialize(strval($profile));
        if (is_array($ar)) {
            $this->Profile = array_merge($this->Profile, $ar);
        }
    }

    // Write (var_dump) profile
    public function writeProfile()
    {
        var_dump($this->Profile);
    }

    // Clear profile
    protected function clearProfile()
    {
        $this->Profile = [];
    }

    // Clear profile (alias)
    public function clear()
    {
        $this->clearProfile();
    }

    // Profile to string
    protected function profileToString()
    {
        $data = array_diff_assoc($this->Profile, $this->Excluded);
        return serialize($data);
    }
}

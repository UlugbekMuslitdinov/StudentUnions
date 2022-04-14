<?php

use Drupal\DrupalExtension\Context\RawDrupalContext;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends RawDrupalContext implements SnippetAcceptingContext {

  /**
   * Initializes context.
   *
   * Every scenario gets its own context instance.
   * You can also pass arbitrary arguments to the
   * context constructor through behat.yml.
   */
  public function __construct() {
  }

  /**
   * Opens the page whose relative URL consists if a prefix, date and title
   * Example: Given I am on the "news" page from "today" called "new-light-origins-bear-down"
   * Example: When I go to the "news" page from "today - 10" called "new-institute-favors-views-held-state-legislators"
   *
   * @Given /^(?:|I )am on the "(?P<prefix>[^"]+)" page from "(?P<datetime>[^"]+)" called "(?P<title>[^"]+)"$/
   * @When /^(?:|I )go to the "(?P<prefix>[^"]+)" page from "(?P<datetime>[^"]+)" called "(?P<title>[^"]+)"$/
   */
  public function visitPrefixedDatedPage($prefix, $datetime, $title) {
    $url = array('', $prefix);
    $timestamp = strtotime($datetime);
    if ($timestamp !== FALSE) {
      $url[] = date('Y/m', $timestamp);
    }
    $url[] = $title;
    $this->visitPath(implode('/', $url));
  }

  /**
   * Checks that the CSS selector finds an element matching a date/time string
   * Example: Then I should see a date matching "today" in the ".published" element
   * Example: And I should see a date matching "today -10 days" in the ".date-display" element
   *
   * @Then /^(?:|I )should see a date matching "(?P<datetime>[^"]+)" in the "(?P<element>[^"]*)" element$/
   */
  public function assertElementMatchesDate($element, $datetime) {
    $timestamp = strtotime($datetime);
    if ($timestamp === FALSE) {
      $datetext = '';
    } else {
      $datetext = date('l, F j, Y', $timestamp);
    }
    $this->assertSession()->elementTextContains('css', $element, $datetext);
  }

  /**
   * Checks that the CSS selector does not find an element matching a date/time string
   * Example: Then I should not see a date matching "today" in the ".published" element
   * Example: And I should not see a date matching "today -10 days" in the ".date-display" element
   *
   * @Then /^(?:|I )should not see a date matching "(?P<datetime>[^"]+)" in the "(?P<element>[^"]*)" element$/
   */
  public function assertElementNotMatchesDate($element, $datetime) {
    $timestamp = strtotime($datetime);
    if ($timestamp === FALSE) {
      $datetext = '';
    } else {
      $datetext = date('l, F j, Y', $timestamp);
    }
    $this->assertSession()->elementTextNotContains('css', $element, $datetext);
  }


}

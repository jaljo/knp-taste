<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }
    
    /**
     * @Given I am on the registeration page
     */
    public function iAmOnTheRegisterationPage()
    {
        $this->visit("/user/register");
    }

    /**
     * @When I fill the regisration form
     */
    public function iFillTheRegisrationForm()
    {
        throw new PendingException();
    }

    /**
     * @When I submit it
     */
    public function iSubmitIt()
    {
        throw new PendingException();
    }

    /**
     * @Then I should be redirected to the login page
     */
    public function iShouldBeRedirectedToTheLoginPage()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see my account creation confirmation message
     */
    public function iShouldSeeMyAccountCreationConfirmationMessage()
    {
        throw new PendingException();
    }
}

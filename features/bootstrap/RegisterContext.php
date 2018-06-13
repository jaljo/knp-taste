<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;

/**
 * Defines application features from the specific context.
 */
class RegisterContext implements Context
{    
    /**
     * @var App\Kernel
     */
    private $kernel;
    
    /**
     * @var Behat\MinkExtension\Context\MinkContext
     */    
    private $minkContext;
    
    /** 
     * @BeforeScenario
     */
    public function gatherContexts(BeforeScenarioScope $scope)
    {
        $environment = $scope->getEnvironment();

        $this->minkContext = $environment->getContext('Behat\MinkExtension\Context\MinkContext');
    }
    
    /**
     * @Given I am on the registeration page
     */
    public function iAmOnTheRegisterationPage()
    {
        $this->minkContext->visit("/user/register");
    }

    /**
     * @When I fill the regisration form
     */
    public function iFillTheRegisrationForm()
    {
        $this->minkContext->fillField("user[username]", "foo");
        $this->minkContext->fillField("user[password]", "bar");
        $this->minkContext->fillField("user[email]", "foo.bar@knplabs.com");
    }

    /**
     * @When I submit the registration form
     */
    public function iSubmitTheResgistrationForm()
    {
        $this->minkContext->pressButton("user_submit");
    }

    /**
     * @Then I should be redirected to the login page
     */
    public function iShouldBeRedirectedToTheLoginPage()
    {
        $this->minkContext->assertPageAddress("/login");
    }

    /**
     * @Then I should see my account creation confirmation message
     */
    public function iShouldSeeMyAccountCreationConfirmationMessage()
    {
        $this->minkContext->assertElementContainsText(".flashbag-message", "Successful registration !");
    }
}

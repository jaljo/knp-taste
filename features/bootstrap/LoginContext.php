<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;

/**
 * Defines application features from the specific context.
 */
class LoginContext implements Context
{             
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
     * @Given I am on the login page
     */
    public function iAmOnTheLoginPage()
    {
        $this->minkContext->visit("/login");
    }

    /**
     * @When I fill the login form
     */
    public function iFillTheLoginForm()
    {
        $this->minkContext->fillField("_email", "foo.bar@knplabs.com");
        $this->minkContext->fillField("_password", "bar");
    }

    /**
     * @When I submit the login form
     */
    public function iSubmitTheLoginForm()
    {
        $this->minkContext->pressButton("_login");
    }
    
    /**
     * @Then I should be redirected to the cooking courses index page
     */
    public function iShouldBeRedirectedToTheCookingCoursesIndexPage()
    {
        $this->minkContext->assertPageAddress("/course/");
    }     
}

<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Behat\Tester\Exception\PendingException;

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
        throw new PendingException();
    }

    /**
     * @When I fill the login form
     */
    public function iFillTheLoginForm()
    {
        throw new PendingException();
    }

    /**
     * @Then I should be redirected to the cooking courses index page
     */
    public function iShouldBeRedirectedToTheCookingCoursesIndexPage()
    {
        throw new PendingException();
    }     
}

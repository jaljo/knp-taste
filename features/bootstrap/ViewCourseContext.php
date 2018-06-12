<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Behat\Tester\Exception\PendingException;

/**
 * Defines application features from the specific context.
 */
class ViewCourseContext implements Context
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
     * @Given I am logged as an admin
     */
    public function iAmLoggedAsAnAdmin()
    {
        throw new PendingException();
    }

    /**
     * @When I click on a course name
     */
    public function iClickOnACourseName()
    {
        throw new PendingException();
    }

    /**
     * @Then I should access the course details
     */
    public function iShouldAccessTheCourseDetails()
    {
        throw new PendingException();
    }

    /**
     * @Given I am logged as a user
     */
    public function iAmLoggedAsAUser()
    {
        throw new PendingException();
    }

    /**
     * @Given I already watched ten videos
     */
    public function iAlreadyWatchedTenVideos()
    {
        throw new PendingException();
    }

    /**
     * @Given The last video I watched was one day before
     */
    public function theLastVideoIWatchedWasOneDayBefore()
    {
        throw new PendingException();
    }

    /**
     * @Then I should not be able to watch the video
     */
    public function iShouldNotBeAbleToWatchTheVideo()
    {
        throw new PendingException();
    }

    /**
     * @Given The last video I watched was too recent
     */
    public function theLastVideoIWatchedWasTooRecent()
    {
        throw new PendingException();
    }

    /**
     * @Then I recieve an error message
     */
    public function iRecieveAnErrorMessage()
    {
        throw new PendingException();
    }    
}

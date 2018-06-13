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
     * @Given I am logged as and admin :arg1 :arg2
     */
    public function iAmLoggedAsAndAdmin($arg1, $arg2)
    {
        $this->minkContext->visit("/login");
        
        $this->minkContext->fillField("_email", $arg1);
        $this->minkContext->fillField("_password", $arg2);

        $this->minkContext->pressButton("_login");        
    }

    /**
     * @When I click on a course name
     */
    public function iClickOnACourseName()
    {
        $this->minkContext->visit("/course/1");
        $this->minkContext->assertPageAddress("/course/1");
    }

    /**
     * @Then I should access the course details
     */
    public function iShouldAccessTheCourseDetails()
    {
        $this->minkContext->assertElementOnPage("#youtube-video");
    }

    /**
     * @Given I am logged as a user :arg1 :arg2
     */
    public function iAmLoggedAsAUser($arg1, $arg2)
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

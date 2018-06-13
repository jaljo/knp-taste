<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;

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
     * @Given I am logged in
     */
    public function iAmLoggedIn()
    {
        $this->minkContext->visit("/login");

        $this->minkContext->fillField("_email", "user1@knplabs.com");
        $this->minkContext->fillField("_password", "user1");

        $this->minkContext->pressButton("_login");
    }

    /**
     * @Given I am on the available courses page
     */
    public function iAmOnTheAvailableCoursesPage()
    {
        $this->minkContext->assertPageAddress("/course/");
    }

    /**
     * @When I click on a course link
     */
    public function iClickOnACourseLink()
    {
         $this->minkContext->clickLink("Organized 24hour paradigm");
    }

    /**
     * @Then I should see the course video
     */
    public function iShouldSeeTheCourseVideo()
    {
        $this->minkContext->assertElementOnPage("#youtube-video");
    }
}

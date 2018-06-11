<?php

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Hook\Scope\AfterScenarioScope;
use App\Kernel;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context
{    
    /**
     * @var Kernel
     */
    private $kernel;
    
    public function __construct()
    {
        $this->kernel = new Kernel("dev", true);
        $this->kernel->boot();
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
        $this->fillField("user[username]", "foo");
        $this->fillField("user[password]", "bar");
        $this->fillField("user[email]", "foo.bar@knplabs.com");
    }

    /**
     * @When I submit it
     */
    public function iSubmitIt()
    {
        $this->pressButton("user[submit]");
    }

    /**
     * @Then I should be redirected to the login page
     */
    public function iShouldBeRedirectedToTheLoginPage()
    {
        $this->assertPageAddress("/login");
    }

    /**
     * @Then I should see my account creation confirmation message
     */
    public function iShouldSeeMyAccountCreationConfirmationMessage()
    {
        $this->assertElementContainsText(".flashbag-message", "Successful registration !");
    }
    
     /**
      * @AfterScenario
      * @todo fix doctrine connection to use .env parameters
      */
     public function cleanDB(AfterScenarioScope $scope)
     {
         $container = $this->kernel->getContainer();
         $connection = $container->get("doctrine")->getManager()->getConnection();
         
         $deleteStatement = $connection->prepare('DELETE FROM user WHERE email = "foo.bar@knplabs.com";');
         $deleteStatement->execute();
     }    
}

Feature: Register user
    In order to use the application
    As an anonymous user
    I should be able to register a new account

    Scenario: Register user
        Given I am on the registeration page
        When I fill the regisration form
        And I submit the registration form
        Then I should be redirected to the login page
        And I should see my account creation confirmation message

Feature: Login user
    In order to access cooking courses
    As an anonymous user
    I should be able to log in

    Scenario: Login user
        Given I am on the login page
        When I fill the login form
        And I submit the login form
        Then I should be redirected to the cooking courses index page


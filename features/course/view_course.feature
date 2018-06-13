Feature: View course
    In order to improove my cooking skills
    As a logged in user
    I should be access a course page

    Scenario: View course
        Given I am logged in
        And I am on the available courses page
        When I click on a course link
        Then I should see the course video

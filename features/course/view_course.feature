Feature: View course
    In order to improve my cooking skills
    As a logged-in user
    I should be able to watch a cooking video 

    Scenario: View course - admin
        Given I am logged as and admin "admin@knplabs.com" "admin"
        When I click on a course name       
        Then I should access the course details

    Scenario: View course - user
        Given I am logged as a user "foo" "bar"
        When I click on a course name       
        Then I should access the course details

    Scenario: View course - user - limit not exeeded
        Given I am logged as a user "foo" "bar"
        And I already watched ten videos
        And The last video I watched was one day before
        When I click on a course name       
        Then I should not be able to watch the video

    Scenario: View course - user - limit exeeded
        Given I am logged as a user "foo" "bar"
        And I already watched ten videos
        And The last video I watched was too recent
        When I click on a course name       
        Then I should not be able to watch the video
        And I recieve an error message
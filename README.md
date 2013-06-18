Teamsoft team management software.


Requirements for Fahrenheit :

These are the basic requirements of the Fahrenheit application that needs to be done. It is still under heavy development.

NOTE : All of these should have a REST API as well so that the mobiles and other applications can connect to it.

This is the User module and this would be linked to everything else.
User registration
User activation using email
There should be a forgot password as well.   
The user should be able to edit his profile only and should also be able to add a profile picture and write his about me too.
Most importantly, there should be the 'slug' URL to have something like the url of www.example.com/username 
The user should be able to put up his to do and submit it. ( Which would include a detailed report on the analysis as well)
User Status post and he should also be able to edit it and delete as well.
User Status comment and he should also be able to edit it and delete it as well.
User can add amount of money spent ( which would be approved by the moderator)
User can see the amount of money he has spent.
User can see the calendar and then plan his events accordingly.
User can see his to-do list that has been assigned to him and he can see the deadline and it would also tell him amount of time that is left to complete his work.
User can see the team and the overall graph using the graphs to see how much of the work has been completed.
User should have the option of adding complaints and user feedbacks.
The user should be able to message other users.
The user should be able to go to the resource page and add materials to read and which can be accessed by other users as well. This can be doc files and pdf, images etc.
User can see the overall gallery where all the images of the to do are done up.
Each time a user adds up a status/comment/to-do or if a new user is added., it should come up as notification to all the users and that they can see the events. 
The user should be able to chat with the other users who are online. ( I can probably use comet chat for this purpose)
The user should be able to subscribe to RSS feeds as well which would give all the information of the events that are occurring such as new user entry and user status/comments and other issues as well.
There should be proper Captcha as well on the forms to prevent bots as well. ( However this is an optional thingy as the bots would not be able to enter a logged in user)
Finally the user should also be able to edit the blog and add his own thoughts to it.
----------------------------------

The To-Do module (This is the module that is controlled by the moderator only) : 

He should have all the facilities of the basic user functionality.
There should be an admin user who would assign moderators who would set up the to-do list and he would be the one who would be assigning members to his team.
The moderator should be able to assign a to-do to one or more of his teammates and then he can add a deadline to the to-do which has to be completed.
He should also be able to delete the money added by the users. Or he can delete them as well. ( However all the data shall be saved for later log. )
He should be able to see the complaints that has been put up. 
He should be able to alter the dates of the to-do list.
He can also tag a user. A moderator has the authority to tag a user, not to ban him. The authority to ban a user only lies within the admin.
The moderator should also be able to remove the tag that may have been applied to a user.

-----------------------------------

If a user is Tagged then he has the following things that he should be able to do :

He would be shown the reason of the Tag and be told that he would have limited functionality.
He would also shown the to-do list and he can upload his to-do list task.
He would be shown a form where he can message the admin directly. 

If however a user is Banned then he should be able to do only the following :

A message showing that the user is banned
A form where he can send a message directly to the admin. Only the admin can remove a ban on a user.


-------------------------------------

Admin module : 

It would have same functionality except for the fact that the admin would be the one who would accept the final user activation.

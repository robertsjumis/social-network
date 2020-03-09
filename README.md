### To do

Tests for implemented functionalities

Code refactor:
- Polymorphism implemented to likes & followers / friends
- Navigation bar implemented as a layout in view files

Validations (Request classes) for all user input forms

Policies:
- likes, unlikes, follows, friends, post updates, gallery updates, etc

Plugin for text editing in posts/create & post/edit

Services added:
- upload image service
- image thumbnail service





# Social network

Features list  
- Registration
- Login
- Password recovery (with email)
- Profile
- Posts wall
- Friends
- Followers
- Pictures gallery
- Like feature

###### Registration  

Registration should consist of following fields:  
- Name
- Surname
- Email
- Password

Password must be confirmed with secondary fields

##### Login  

Authorization into social network by email and password.

##### Password recovery

Password recovery by entering an email where recovery link is sent.  
Password can be changed and minimal requirement when changing the password is 6 characters.

##### Profile

Option to set/change profile picture.  
Every aspect of information should be able to change.  
Additional fields that must be added to profile edit and displays within the profile view  
- Phone number
- Address
- Bio
- Birthday

All of this information must be displayed when opening the profile view.
Profile link should consist of friendly readable name like - /1-john-doe, 2-jane-doe

##### Post wall

Users can add new posts to their walls.  
Post consists of adding the text, that can be formatted bold, italic, underline etc.  
When someone opens persons profile he can see profile information and his posts.  
Your post wall consists of your own posts & follower posts.  

##### Friends

Option to friend request someone.  
When accepted you both become each other friends.  
Friends should be displayed in each persons profile.    
When you become friends you also become followers of each other.  
You can follow/unfollow, friend/unfriend person based on your current status of him.  
When you unfriend person you also unfollow his content.  

##### Followers  

Followers can see your content (posts) in their feed.  
You can follow someone without his permission.  

##### Picture gallery  

Option to create a gallery and add multiple pictures.  
Pictures are displayed in the profile.  
Everyone can see their pictures.  
You should be able to delete or add new pictures in the gallery after a period of time.  

###### Likes

You can like persons pictures, posts.  
Likes can be removed.  
Pictures & posts display amount of likes.  

**Approach** This should use polymorphism!

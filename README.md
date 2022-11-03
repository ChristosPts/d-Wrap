# **dWrap**

### Languages: HTML/CSS/Javascript/PHP/Sql

**dWrap** is a simple image hosting website for desktop wallpapers. It allows visitors to browse, upload, download, like and delete pictures, create/delete accounts etc.   

Visitors are split into three categories: 
1) Guests which are any visitors without an account or have not logged in. 
2) Users those who are logged into their account.  
3) Admins whose role is granted through the database to moderate the website.<br/>

Each category has the following permissions

### Guest
- Download Images
- Browse by categories
- Sort by views, likes, age or randomize the images
- Order by ascending or descending order

### User
- Guests permissions
- Upload Images
- Upload Profile Image
- Report Images
- Like Images

### Admin
- User and Guests permissions
- Delete images uploaded by other users
- Delete profiles of other users

**Disclaimer**
In the includes folder in deleteImg.php, deleteProfile.php, PassResetReq.php and signup.php the appropriate email address needs to be given for the local mail service to work


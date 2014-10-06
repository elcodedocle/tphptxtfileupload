tphptxtfileupload
=================

Tiny PHP .txt file upload framework / RESTful service


###Usage

Usage is pretty straight forward. You can test it on http://geovolutions.com/playground/fileattachment/form.html


###Deployment

 - Don't forget to set write permissions to your web server user on the destination
folder.

e.g. 

```
chown apache: /var/www/uploads && chmod 700 /var/www/uploadsCheck 
```

 - And `.htaccess` rules (or equivalent if you are not using apache) / non public 
destination folder, if you want to avoid the files being exposed to the public. 


 - Check the code for more details.

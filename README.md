# Platform Beta

Now the era of writing code for classic **"Corporate Site**" and similar jobs is over
"**Vobo Cloud**" is powered by the " **Fix Framework**" developed specifically for the sass backbone structure. It is used quickly and functionally thanks to its easy-to-access encoded infrastructure in plain language.

With the sass feature, you can define individual plugins for each site that opens and manage components as you wish. For registered sites, the registration limit is set separately.

With the developed plug-in infrastructure, fully integrated plug-ins can be developed on the system. It has a positive effect on users with its easy-to-use interface and operations.

Api documentation is automatically prepared for the created components, it creates a sample code fragment, data connection, and process links in the created document.

### Road map

- [x] Setup support screen
- [x] User management
- [x] Api management
- [x] Component management
- [x] Creating modules
     - [x] Multi module
     - [x] Single module
- [x] Edit module
- [x] Plugin management
- [ ] Interface language management (Default English)
- [x] Interface customization



### Features

- Setup assistant
- Advanced user management
- User authority management
- Api key management
- Automatic API document creation
- Multiple site creation (SAAS)
- Multiple attachment assignment
- Advanced plugin development
- Mysql database support
- Robust and powerful coding infrastructure
- Software reading standards
- Data logging in different languages
- Menu management
- Import and Export data stream
- Special Backup infrastructure
- Automatic form processing
------------

###Form Elements

1. Text input
2. Tags input
3. Select - Option
4. Radio – Option
5. Checkbox - Option
6. Number input
7. Photo manager
8. Text editor
9. Color select
10. Multi Select – Option
11. Textbox
12. Input mask
13. Random
14. Date

### Project Requirements
1. Os:Centos7
	 Ram : 2 Gb
	Cpu : 4 Core
	Disk : 20 Gb
	Network : 100Mbit
2. Engine:Nginx&Mysql&Php
3. Technical information little. for install

## INSTALLATIONS STEPS

1. Copy files to server Upload the files required for installation to the server completely.
If you using apache : use .htaccess

	If you using nginx set index file fix.php:
		if (!-e $request_filename){
		rewrite ^/([^?]*)$ /fix.php?url=$1 last; break;
		}
Go to your install domain. domain.com/install Enter your database information to be installed

	Default Root Account : demo@demo.com | 123

	Import Sample Data

	You can see the working structure of the system by uploading the sample data.

	Login > Settings > System Management and click Import (Go)




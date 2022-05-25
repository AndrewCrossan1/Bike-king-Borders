# Bike-king-Borders

## Project Description
This project is for Developing Websites for Multiplatform use as part of my HND in Computing: Software Development

The project shows use of CRUD for creating, reading, updating and deleting different objects like products, special offers and users.

## The scenario

As part of the module we have been given a scenario to base our website from, and the scenario we have been given is Bike King Borders, a growing bike hiring
and servicing company based in the borders of Scotland.<br>

Currently as of 29/03/22 the website features the following:

- User Account login and creation
- Database connectivity (Obviously for the point above)
- Viewing of products by user
- Filtering of products using SQL
- URL Rewriting for improved SEO
- Admin logging in and logging out
- JavaScript IP gathering and website Entry Time gathering.
- Admins can delete products
- Admins can add products
- Admins can read products, offers and sales.
- Admins can update products
- Products previews are displayed
- A contact page where users can create tickets which can be viewed and replied to by administrators on an admin only page
- The ability to add a product to basket and checkout
- The ability for users to apply special offers
- Live Search function using PHP, and AJAX.
- A gallery containing images of trails and bikes which can be scrolled through by the user
- More content on each page
- The ability to create special offers
- Admins having the ability to update user passwords
- Keybindings which keyboard-only users can use to navigate the website
- Specific product viewing page

Soon I wish to implement the following features in the website
- Offer viewing page


The deadline for this project is 2/6/22

## Testing 
Testing is carried out thoroughly after the development of each module (Usually by me using example accounts as a way of end user testing)
<br>
Product filtering is tested using different cases, some examples:

<hr/>

- Price Range: £0 - £410 | Type: Mountain | Colour: Black

![BlackMountain410](https://user-images.githubusercontent.com/74681613/161100272-f1d89448-5b26-4bdb-a89d-a97ea593d6fe.PNG)

<hr/>

- Price Range: £0 - £1000 | Type: None | Colour: Black

![BlackBikes1000](https://user-images.githubusercontent.com/74681613/161100698-3b164eab-98a0-4b70-881a-139cb38d3092.PNG)

<hr/>

- Price Range: £0 - £1000 | Type: Hybrid | Colour: None

![Hybrid1000](https://user-images.githubusercontent.com/74681613/161100942-5b8495fc-4b36-4236-ac30-bbbb718df787.PNG)




## Technologies used
The project is majorly developed using PHP for scripting, where applicable I have went down the object-oriented route to enhance my OOP practising.

MySQLi is my choice for accessing databases.

The project is hosted on a docker container running PHP-Apache, MySQL and PHPMyAdmin (You can't use it unless you plan on stealing my laptop)

Adobe XD is my choice of software for developing wireframes for the site.

The IDE I primarily use for this project is PHPStorm, it ticks all the boxes and gets the job done efficiently and in a robust manner.

## Wireframes
/admin/home/

![image](https://user-images.githubusercontent.com/74681613/163696491-0aebd1d5-719b-47ce-85fe-cb6e7ca4c156.png)

## Evaluating as I progress
For the next major version of this site I plan to utilise:
- PHP.INI for auto starting sessions on each page
- Incorporating a settings.php file which includes media urls - Technically done but not to the extent I want
- A static folder for holding css, js and others
- No Code-Behind style of writing (PHP Pages will only require and include necessary files)
- More focus on the modelling of database tables (I neglected them halfway through)
- Using more advanced SQL (Multi-Table Insert for account creation)
- Creating functions of constantly used scripts, like redirecting if not logged in or not admin using JavaScript
- Less repetition of scripts where one function can be modified to accommodate all uses (Getting something from a database)
- Using composer packages: Twig, Google Captcha and Facebook authentication.
- Keeping all edit, delete, add and confirm actions in three files, doing it for each object is not good practice.
- Create forms.php, which contains forms with names, so add, delete, edit for a more dynamic webpage, keys in with above point.
- In general, better programming, this is probably the ugliest code I have genuinely ever written, V2 will be much better.
- Specific Product viewing
- Specific Account Viewing
- Specific Offer Viewing
- Asynchronous retrieval and updating of user data using $.get method.
- Product Reviewing system
- Bike King Borders Points Reward system

## Credits

The website has been developed by Andrew Crossan (Me!) :joy:

It serves as an example of my work for potential employers or educators and also an assignment for my HND.

If you wish to use my code or get in contact give me a message on Twitter 🙂

<a href="https://twitter.com/andrewcrossan11">My Twitter 😸</a>

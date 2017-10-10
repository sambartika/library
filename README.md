# library
This project is a web based project developing library system
To run the application user needs to go to the URL : http://students.cse.tamu.edu/archana/library
The application provides the functionalities:
Once the URL is opened, the home page of library system opens up. The user need to login first for searching books or other functionalities. There are two types of users, 1) normal user, 2) admin. 
Normal user can only search books or view topics. Admin has the option to update the availability of books, insert new books, insert new topics, delete books, delete topics etc. 
For login purpose, user can click on LOGIN option in the header or click on Login to continue button. Then user mailid and password needs to be entered. 
Two normal user credentials are, 
Emai: donette.foller@cox.net
Password: Donette.Foller@5
Email: simona@morasca.com
Password: Simona.Morasca@6
Two admin user credentials are,
Email: lnestle@hotmail.com
Password: Lorrie.Nestle@52
Email: hdemesa@cox.net
Password: Herman.Demesa@125
Once the user login, 
1.	If the user is a normal member, the header of the website will show 5 options. On click of each option the corresponding functionalities are provided. Functionalities listed below:
a.	Home: which will take user to the home page
b.	Search books: The user can enter the book / author/ topic/ department name and select the appropriate option from the dropdown and search. If books exists satisfying the condition, the page will show the book details, availability, location of the matched books.
	Example inputs for book name :  Discrete Mathematics and its Applications,  Introduction to Cryptography
	Example inputs for book author:  Simon Haykin,  John Uffenbeck
	Example inputs for book topic: Switching Circuits and Logic Design, Operating Systems
	Example inputs for department: Computer Science, Electrical & Electronics Engineering
c.	View topics: It will show the list of the topics, their departments. On click of topic name the page will redirect to search page and show all the books of that topic
d.	Update profile: The users can change their name, phone number, emailid, password etc and click the update button. The changes will be made.
e.	Logout: The users can logout by clicking the logout button.
2.	If the user is an admin, the header of the website will show 10 options. 5 of them are same as the normal user. The additional 5 options are there. On click of each of that option the corresponding functionalities are provided. Functionalities listed below:
a.	Change availability: To change the availability of a book, admin need to enter the correct book name and author and click on search. If any such book exists, it will show the book. Then admin can select yes or no from the dropdown and click on enter. The change will be done.
	Example inputs: (Book name -  Analysis and Simulation of Semiconductor Devices, Book Author-  S. Selberherr), (Book Name-  High-Speed Semiconductor Devices, Book Author-  Sze Simon M)
b.	Add book: To add a book, admin need to enter the book name, author, topic name and click on add book. If any such topic exists then the book will be added to the library.
	Example valid topics: Algorithms I, Programming and Data Structures
c.	Add topic: To add a topic, admin need to enter the topic name, select the correct department from the drop down and click on add topic. The book will be added to the library.
d.	Remove book: To delete a book, admin need to enter the correct book name and author and click on search. If any such book exists, it will show the book. Then admin can select yes or no from the dropdown and click on delete button. The book will be deleted. 
	Example inputs: (Book name -  Analysis and Simulation of Semiconductor Devices, Book Author-  S. Selberherr), (Book Name-  High-Speed Semiconductor Devices, Book Author-  Sze Simon M)
e.	Remove topic: To remove a topic, admin needs to enter the topic name and click enter. If any such topic exists then the topic will be deleted.
	Example inputs: Formal Languages and Automata Theory, Distributed Systems

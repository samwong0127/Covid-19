# COVID-19 tracking app server

The server is written by PHP and communicates with the relational database by SQL.

The backend logic could be revised with Python to create a Flask server and MongoDB for scalability with Docker.

The basic functions are 
1. Login, Registration
2. Updating & Uploading
3. Retrieving Covid-19 data from data.gov.hk
4. Comparison the locations of the user and confirmed cases.

Update suggestions
1. Salt-hashed password storage in database
2. Faster comparsion by matching location ID/district

# Setup & Development
Run `php -S localhost:4000` to start a development webserver.  
`http://localhost:4000/fetch.php` will pull in the data.

# Deployment
'lftp' has to be installed.  
Make sure you have setup the `.environment` file, use `.environment.template` as a template.

Build the project with `bundle exec middleman build` and deploy it with `./deploy`.

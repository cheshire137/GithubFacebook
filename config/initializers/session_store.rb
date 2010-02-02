# Be sure to restart your server when you modify this file.

# Your secret key for verifying cookie session data integrity.
# If you change this key, all old sessions will become invalid!
# Make sure the secret is at least 30 characters and all random, 
# no regular words or you'll be exposed to dictionary attacks.
ActionController::Base.session = {
  :key         => '_GithubFacebook_session',
  :secret      => 'a414824a383075c0e1977a7f29ac456e2e5193c7a544aca13f0dafcc1c62fa5b1fab3113f95b8c35fd51480951efd106906412d64bd7afcd3e4131bd4ecbe6b3'
}

# Use the database for sessions instead of the cookie-based default,
# which shouldn't be used to store highly confidential information
# (create the session table with "rake db:sessions:create")
# ActionController::Base.session_store = :active_record_store

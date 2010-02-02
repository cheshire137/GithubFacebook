class User < ActiveRecord::Base
  set_primary_keys :facebook_id, :github_name
end

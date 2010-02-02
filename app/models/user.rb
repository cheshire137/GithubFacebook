class User < ActiveRecord::Base
  set_primary_keys :facebook_id, :github_name
  validates_presence_of :facebook_id, :github_name
end

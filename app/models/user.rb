class User < ActiveRecord::Base
  set_primary_keys :facebook_id, :github_name
  validates_presence_of :facebook_id, :github_name
  belongs_to :github, :foreign_key => 'github_name'
  
  def validate
    unless Github.user_exists?(github_name)
      errors.add(:github_name, 'is not a registered Github user')
    end
  end
end

class User < ActiveRecord::Base
  set_primary_keys :facebook_id, :github_name
  validates_presence_of :facebook_id, :github_name
  
  def User.valid_github?(user_name)
    return false if user_name.nil? || user_name.empty?
    GitHub::API.user(user_name)
    true
  rescue OpenURI::HTTPError
    false
  end
  
  def repositories
    GitHub::Api.user(github_name).repositories
  rescue
    []
  end
  
  def validate
    unless User.valid_github?(github_name)
      errors.add(:github_name, 'is not a registered Github user')
    end
  end
end

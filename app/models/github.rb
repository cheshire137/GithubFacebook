class Github
  BASE_URL = 'http://github.com/api/v2/yaml'
  attr_accessor :name
  
  def initialize(n)
    if Github.user_exists?(n)
      @name = n
    else
      raise ArgumentError
    end
  end
  
  def Github.user_exists?(user_name)
    GitHub::API.user(user_name)
    true
  rescue OpenURI::HTTPError
    false
  end
  
  def repositories
    GitHub::Api.user(@name).repositories
  rescue
    []
  end
end

class UserMailer < Facebooker::Rails::Publisher
  def profile(user)
    send_as :profile
    from user
    recipients user
    fbml = "Github test:  This is some test FBML that will be inserted into a user's profile."
    profile(fbml)
    profile_main(fbml)
  end
end
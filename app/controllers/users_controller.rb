class UsersController < ApplicationController
  before_filter :get_user
  
  def index
    @page_title = "Home"
    @users = User.find :all
    respond_to do |format|
      format.fbml # index.fbml.erb
      format.xml  { render :xml => @users }
    end
  end
  
  def get_user
    @current_user = User.find_or_create_by_facebook_id(facebook_session.user.id)
  end
end

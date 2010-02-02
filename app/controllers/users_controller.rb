class UsersController < ApplicationController
  before_filter :get_user
  
  def create
    unless request.post?
      flash[:error] = 'Please use the form provided'
      redirect_to :action => 'index' and return
    end
  end
  
  def index
    @page_title = "Home"
    @users = User.find_all_by_facebook_id @facebook_id
    @user = User.new
    
    respond_to do |format|
      format.fbml # index.fbml.erb
      format.xml  { render :xml => @users }
    end
  end
  
  def get_user
    @facebook_id = facebook_session.user.id
  end
end

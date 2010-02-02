class UsersController < ApplicationController
  def create
    unless request.post?
      flash[:error] = 'Please use the form provided'
      redirect_to :action => 'index' and return
    end
    
    unless params[:user]
      flash[:error] = 'No data given'
      redirect_to :action => 'index' and return
    end
    
    if User.create(params[:user])
      flash[:notice] = 'Successfully added Github name'
      redirect_to :action => 'index'
    else
      flash[:error] = 'Could not add Github name'
      @facebook_id = facebook_session.user.id
      @users = User.find_all_by_facebook_id @facebook_id
      @user = User.new(params[:user])
      render :template => 'index'
    end
  end
  
  def index
    @page_title = "Home"
    @facebook_id = facebook_session.user.id
    @users = User.find_all_by_facebook_id(@facebook_id)
    @user = User.new(:facebook_id => @facebook_id)
  end
end

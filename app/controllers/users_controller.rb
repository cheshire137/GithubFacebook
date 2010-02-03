class UsersController < ApplicationController
  ensure_authenticated_to_facebook

  def create
    unless request.post?
      flash[:error] = 'Please use the form provided'
      redirect_to :action => 'index' and return
    end
    
    unless params[:user]
      flash[:error] = 'No data given'
      redirect_to :action => 'index' and return
    end
    
    @facebook_id = facebook_session.user.id
    params[:user][:facebook_id] = @facebook_id
    @user = User.new(params[:user])
    
    if @user.save
      flash[:notice] = 'Successfully added Github name'
      redirect_to :action => 'index'
    else
      flash[:error] = 'Could not add Github name'
      @users = User.find_all_by_facebook_id @facebook_id
      render :template => 'users/index.fbml.erb'
    end
  end
  
  def delete
    unless params[:github_name] && !params[:github_name].blank?
      flash[:error] = 'No Github name given to delete'
      redirect_to :action => 'index' and return
    end
    
    user = User.find_by_facebook_id_and_github_name(facebook_session.user.id,
      params[:github_name])
    
    if user.nil?
      flash[:error] = 'Cannot delete an invalid user'
      redirect_to :action => 'index' and return
    end
    
    user.destroy
    flash[:notice] = 'Successfully removed Github name'
    redirect_to :action => 'index'
  end
  
  def index
    @page_title = "Home"
    @facebook_id = facebook_session.user.id
    @users = User.find_all_by_facebook_id(@facebook_id)
    @user = User.new(:facebook_id => @facebook_id)
    
    respond_to do |format|
      format.fbml # index.fbml.erb
      format.xml  { render :xml => @users }
    end
  end
  
  def update
    user = User.find_by_facebook_id_and_github_name(facebook_session.user.id,
      params[:github_name])
    
    if user.nil?
      render :text => 'No such user to edit'
      return
    end
    
    user.github_name = params[:value]
    
    if user.save
      render :text => user.github_name
    else
      error_msg = user.errors.collect do |attrib, value|
        "#{attrib}: #{value}"
      end.join(', ')
      render :text => 'Could not edit Github name: ' + error_msg.to_s
    end
  end
end

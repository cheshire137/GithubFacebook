class CreateUsers < ActiveRecord::Migration
  def self.up
    create_table(:users, :id => false) do |t|
      t.column :facebook_id, :integer
      t.column :github_name, :string
    end
    execute "ALTER TABLE users ADD PRIMARY KEY(facebook_id, github_name);"
  end

  def self.down
    drop_table :users
  end
end

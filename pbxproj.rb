#!/usr/bin/ruby

#create Project File and save
Xcodeproj::Project.new("./Test1.xcodeproj").save

#open Project
proj = Xcodeproj::Project.open("./Test1.xcodeproj")

#create a group
testGroup = proj.main_group.new_group("Test","./Test")

#add reference to group
testGroup.newference("AppDelegate.Swift")
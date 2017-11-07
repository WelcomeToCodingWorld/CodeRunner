(*  Here are some

	--nested comments

	(* another comment within a comment *)

*)

--display dialog "This is just a test." buttons {"Great", "OK"}¬ 
--default button "OK" giving up after 3 

--end-of-line comments extend to the end of the line
get name of front window of application "Finder"

set myName to "John"
copy "Jane" to myName

tell application "Finder"

	set savedName to name of front window

	close window savedName

end tell
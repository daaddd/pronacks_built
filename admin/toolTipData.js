var FiltersEnabled = 0; // if your not going to use transitions or filters in any of the tips set this to 0
var spacer="&nbsp; &nbsp; &nbsp; ";

// email notifications to admin
notifyAdminNewMembers0Tip=["", spacer+"No email notifications to admin."];
notifyAdminNewMembers1Tip=["", spacer+"Notify admin only when a new member is waiting for approval."];
notifyAdminNewMembers2Tip=["", spacer+"Notify admin for all new sign-ups."];

// visitorSignup
visitorSignup0Tip=["", spacer+"If this option is selected, visitors will not be able to join this group unless the admin manually moves them to this group from the admin area."];
visitorSignup1Tip=["", spacer+"If this option is selected, visitors can join this group but will not be able to sign in unless the admin approves them from the admin area."];
visitorSignup2Tip=["", spacer+"If this option is selected, visitors can join this group and will be able to sign in instantly with no need for admin approval."];

// snacks table
snacks_addTip=["",spacer+"This option allows all members of the group to add records to the 'Pronacks' table. A member who adds a record to the table becomes the 'owner' of that record."];

snacks_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Pronacks' table."];
snacks_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Pronacks' table."];
snacks_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Pronacks' table."];
snacks_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Pronacks' table."];

snacks_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Pronacks' table."];
snacks_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Pronacks' table."];
snacks_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Pronacks' table."];
snacks_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Pronacks' table, regardless of their owner."];

snacks_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Pronacks' table."];
snacks_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Pronacks' table."];
snacks_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Pronacks' table."];
snacks_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Pronacks' table."];

// ratings table
ratings_addTip=["",spacer+"This option allows all members of the group to add records to the 'Ratings' table. A member who adds a record to the table becomes the 'owner' of that record."];

ratings_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Ratings' table."];
ratings_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Ratings' table."];
ratings_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Ratings' table."];
ratings_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Ratings' table."];

ratings_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Ratings' table."];
ratings_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Ratings' table."];
ratings_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Ratings' table."];
ratings_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Ratings' table, regardless of their owner."];

ratings_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Ratings' table."];
ratings_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Ratings' table."];
ratings_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Ratings' table."];
ratings_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Ratings' table."];

// favorites table
favorites_addTip=["",spacer+"This option allows all members of the group to add records to the 'Favorites' table. A member who adds a record to the table becomes the 'owner' of that record."];

favorites_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Favorites' table."];
favorites_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Favorites' table."];
favorites_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Favorites' table."];
favorites_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Favorites' table."];

favorites_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Favorites' table."];
favorites_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Favorites' table."];
favorites_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Favorites' table."];
favorites_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Favorites' table, regardless of their owner."];

favorites_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Favorites' table."];
favorites_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Favorites' table."];
favorites_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Favorites' table."];
favorites_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Favorites' table."];

/*
	Style syntax:
	-------------
	[TitleColor,TextColor,TitleBgColor,TextBgColor,TitleBgImag,TextBgImag,TitleTextAlign,
	TextTextAlign,TitleFontFace,TextFontFace, TipPosition, StickyStyle, TitleFontSize,
	TextFontSize, Width, Height, BorderSize, PadTextArea, CoordinateX , CoordinateY,
	TransitionNumber, TransitionDuration, TransparencyLevel ,ShadowType, ShadowColor]

*/

toolTipStyle=["white","#00008B","#000099","#E6E6FA","","images/helpBg.gif","","","","\"Trebuchet MS\", sans-serif","","","","3",400,"",1,2,10,10,51,1,0,"",""];

applyCssFilter();

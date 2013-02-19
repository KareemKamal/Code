$(document).ready(function() {
     $("ul#selected-plays > li").addClass("horizontal");
	 $("ul#selected-plays  li").addClass("sub-level");
	 //$("h2:contains(Shakespeare's Plays)").next().children("nth-child(2n+1)").addClass("alt");
	 $("table:first tr:nth-child(2n+1)").addClass("alt");
	 $("table td:contains(Henry)").addClass("highlight");
	 //$("table:first td:contains(1)").addClass("year");
	 $("table:first tr td:nth-child(3)").addClass("year");
	 $("table:first tr td:contains(Tragedy):first").addClass("special").next().removeClass("year").addClass("special");
	 //$("table:first tr td:contains(Tragedy):first").next().removeClass("year").addClass("special");
	 //$("table:first tr td:contains(Tragedy):first").next().addClass("special");
	 
	  });
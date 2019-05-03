use DBI;

$dbh = DBI->connect( "dbi:ODBC:beemail") || die "Cannot connect:     $DBI::errstr";
=pod
## Select based on user input
print "\nDisplaying your received mails \n";
print "Enter to email address ";
$fromemail = <>;
chomp($fromemail);
print "Enter  to  email address ";
$toemail = <>;
chomp($toemail);
=cut

my $sth = $dbh->prepare("select body from mails"); # ? is used to denote that the value can be changed
$sth->execute() or die $DBI::errstr;

while (my @row = $sth->fetchrow_array()) {
   my ($line)=@row;
   if(($greeting,$name,$body)=$line=~ m/^(hi|hello|dear)\sdr\.(\w+)\n(.+|\n+)/ix)
	{
	# print "$line\n";
	 print "nick : $name\n end : $body\n";
	 
	# $`, $&, $'
	+
	# print "regards : $regards\n ";
	 }
}
$sth->finish();

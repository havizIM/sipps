var session     = localStorage.getItem('sipps');
var auth        = JSON.parse(session);
var token       = auth.token;
var nip         = auth.nip;

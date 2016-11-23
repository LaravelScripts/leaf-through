<p>Hi {{ $user->name }},</p>
<p>Go to the link {{ url('confirmation/?email='.$user->email.'&code='.$user->confirmation_hash) }} to confirm the account.</p>
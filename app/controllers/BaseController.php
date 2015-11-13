<?php

class BaseController extends Controller {

    public function __construct()
    {
        // Check the csrf-token on POST requests.
        $this->beforeFilter('csrf', array('on' => 'post'));
	}

	protected function updateUser($user)
	{
		$input = Input::all();

		// Sanitize text
		$input['text'] = Purifier::clean($input['text']);

		$validator = User::validate($input);

		if($validator->passes())
		{
			// Fill without dates because those have to be converted
			// manually.
			$user->fill(array_except($input, array(
				'firstname',
				'lastname',
				'email',
				'group_id'
			)));

			return $user;
		}

		return false;
	}


}

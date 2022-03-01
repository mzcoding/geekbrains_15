<?php

namespace App\Http\Controllers;

use Faker\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function getNews(?int $id = null): array
	{
		$faker = Factory::create();
		$statusList = ["DRAFT", "ACTIVE", "BLOCKED"];
		if($id) {
			return [
				'id'     => $id,
				'title'  => $faker->jobTitle(),
				'author' => $faker->userName(),
				'image'  => $faker->imageUrl(250, 170),
				'status' => $statusList[mt_rand(0,2)],
				'description' => $faker->text(100)
			];
		}

		$data = [];
		for($i=0; $i < 10; $i++) {
			$id = $i +1;
			$data[] = [
				'id'     => $id,
				'title'  => $faker->jobTitle(),
				'author' => $faker->userName(),
				'image'  => $faker->imageUrl(250, 170),
				'status' => $statusList[mt_rand(0,2)],
				'description' => $faker->text(100)
			];
		}

		return $data;
	}
}

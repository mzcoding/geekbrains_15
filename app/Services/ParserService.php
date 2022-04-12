<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Parser as Contract;
use Orchestra\Parser\Xml\Facade as Parser;


class ParserService implements Contract
{
	protected string $url;

	/**
	 * @param string $url
	 * @return ParserService
	 */
	public function setUrl(string $url): self
	{
		$this->url = $url;
		return $this;
	}

	/**
	 * @return void
	 */
	public function saveNews(): void
	{
		$xml = Parser::load($this->url);
		$data =  $xml->parse([
			'title' => [
				'uses' => 'channel.title'
			],
			'link' => [
				'uses' => 'channel.link'
			],
			'description' => [
				'uses' => 'channel.description'
			],
			'image' => [
				'uses' => 'channel.image.url'
			],
			'news' => [
				'uses' => 'channel.item[title,link,guid,description,pubDate]'
			]
		]);
        $json = json_encode($data);
		$e = explode("/", $this->url);
		$fileName = end($e);
		\Storage::append('news/' . $fileName, $json);
	}
}
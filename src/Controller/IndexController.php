<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
	
	/**
	 * @Route("/", name="index")
	 * @return Response
	 */
	public function index(): Response
	{
		$xml = file_get_contents("https://medium.com/feed/@pilloud.anthony");
		$rss = new \SimpleXMLElement($xml, LIBXML_NOWARNING | LIBXML_NOERROR | LIBXML_NOCDATA);
		
		$articles = [];
		
		foreach($rss->channel->item as $article) {
			$content = $article->children("content", true);
			
			$articles[] = [
				"title" => $article->title,
				"link" => explode("?", $article->link)[0],
				"categories" => $article->category,
				"date" => $article->pubDate
			];
		}
		
		return $this->render("index.html.twig");
	}

	/**
	 * @Route("/index", name="base_index")
	 * @return Response
	 */
	public function baseIndex(): Response
	{
		return $this->render("index.html.twig");
	}
}

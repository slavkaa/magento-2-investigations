<?php
declare(strict_types=1);

namespace UnityGroup\Blog\ViewModel;

use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use UnityGroup\Blog\Service\PostRepository;

class Blog implements ArgumentInterface
{
    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;

    /**
     * @var PostRepository
     */
    private PostRepository $postRepository;

    /**
     * @var UrlInterface
     */
    private UrlInterface $urlInterface;

    /**
     * @param SerializerInterface $serializer
     * @param PostRepository $postRepository
     */
    public function __construct(
        SerializerInterface $serializer,
        PostRepository $postRepository,
        UrlInterface $urlInterface
    ) {
        $this->serializer = $serializer;
        $this->postRepository = $postRepository;
        $this->urlInterface = $urlInterface;
    }

    /**
     * @return string
     */
    public function getPosts(): string
    {
        $postsSearchResults = $this->postRepository->get();

        $results = [];

        foreach ($postsSearchResults->getItems() as $post) {
            $results[] = [
                "id" => $post->getId(),
                "title" => $post->getTitle(),
                "url" => $this->urlInterface->getUrl($post->getIdentifier()),
                "author"  => "Jon Snow",
                "content" => $this->truncate(strip_tags($post->getContent()), 50),
                "published_at" => $post->getCreationTime()
            ];
        }

        return $this->serializer->serialize($results);
    }

    /**
     * @param string $text
     * @param int $maxLetters
     * @return string
     */
    private function truncate(string $text, int $maxLetters): string {
        $array = explode(' ', $text);
        if (count($array) > $maxLetters && $maxLetters > 0) {
            $text = implode(' ', array_slice($array, 0, $maxLetters)) . '...';
        }

        return $text;
    }
}

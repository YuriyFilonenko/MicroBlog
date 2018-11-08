<?php

namespace App\Test\Service;

use App\Entity\MicroPost;
use App\Repository\MicroPostRepository;
use App\Repository\MicroPostRepositoryInterface;
use App\Service\MicroPost\MicroPostServiceInterface;
use App\Service\MicroPost\MySqlMicroPost;
use PHPUnit\Framework\TestCase;

/**
 * Test case for MySqlMicroPost service.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class MySqlMicroPostTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp() 
    {
        $this->service = new MySqlMicroPost($this->getMicroPostRepository());
    }
    
    public function testInstanceOfMicroPostServiceInterface()
    {
        self::assertInstanceOf(MicroPostServiceInterface::class, $this->service);
    }
    
    public function testGetListOfPosts()
    {
        $microPostRepository = $this->getMicroPostRepository();
        
        $expected = [new MicroPost];
        
        $microPostRepository->expects(self::once())
            ->method('getListOfPosts')
            ->willReturn($expected)
        ;
        
        $service = new MySqlMicroPost($microPostRepository);
        
        $actual = $service->getListOfPosts();
        
        self::assertEquals($expected, $actual);
    }
        
    public function testGetPostByIdt()
    {
        $microPostRepository = $this->getMicroPostRepository();
        
        $expected = new MicroPost;
        
        $microPostRepository->expects(self::once())
            ->method('getPostById')
            ->willReturn($expected)
        ;
        
        $service = new MySqlMicroPost($microPostRepository);
        
        $actual = $service->getPostById(0);
        
        self::assertEquals($expected, $actual);
    }
    
    public function testAddPost()
    {
        $microPostRepository = $this->getMicroPostRepository();
        
        $post = new MicroPost;
        
        $microPostRepository->expects(self::once())
            ->method('addPost')
            ->willReturn($addedPosts[] = $post)
        ;
        
        $service = new MySqlMicroPost($microPostRepository);
        
        $actual = $service->addPost($post);
        
        self::assertContains($post, $addedPosts);
    }
    
    public function testDeletePostById()
    {
        $microPostRepository = $this->getMicroPostRepository();
        
        $post = new MicroPost;
        
        $posts = [$post];
        
        $microPostRepository->expects(self::once())
            ->method('deletePostById')
            ->willReturn($posts[0] = null)
        ;
        
        $service = new MySqlMicroPost($microPostRepository);
        
        $actual = $service->deletePostById(0);
        
        self::assertNotContains($post, $posts);
    }
    
    private function getMicroPostRepository(): MicroPostRepositoryInterface
    {
        return $this->getMockBuilder(MicroPostRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}

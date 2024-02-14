<?php

namespace App\Test\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProduitControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/produit/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Produit::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Produit index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'produit[titre]' => 'Testing',
            'produit[description]' => 'Testing',
            'produit[image_couverture]' => 'Testing',
            'produit[date_creation]' => 'Testing',
            'produit[moyenne_avis]' => 'Testing',
            'produit[categorie]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Produit();
        $fixture->setTitre('My Title');
        $fixture->setDescription('My Title');
        $fixture->setImage_couverture('My Title');
        $fixture->setDate_creation('My Title');
        $fixture->setMoyenne_avis('My Title');
        $fixture->setCategorie('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Produit');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Produit();
        $fixture->setTitre('Value');
        $fixture->setDescription('Value');
        $fixture->setImage_couverture('Value');
        $fixture->setDate_creation('Value');
        $fixture->setMoyenne_avis('Value');
        $fixture->setCategorie('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'produit[titre]' => 'Something New',
            'produit[description]' => 'Something New',
            'produit[image_couverture]' => 'Something New',
            'produit[date_creation]' => 'Something New',
            'produit[moyenne_avis]' => 'Something New',
            'produit[categorie]' => 'Something New',
        ]);

        self::assertResponseRedirects('/produit/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitre());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getImage_couverture());
        self::assertSame('Something New', $fixture[0]->getDate_creation());
        self::assertSame('Something New', $fixture[0]->getMoyenne_avis());
        self::assertSame('Something New', $fixture[0]->getCategorie());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Produit();
        $fixture->setTitre('Value');
        $fixture->setDescription('Value');
        $fixture->setImage_couverture('Value');
        $fixture->setDate_creation('Value');
        $fixture->setMoyenne_avis('Value');
        $fixture->setCategorie('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/produit/');
        self::assertSame(0, $this->repository->count([]));
    }
}

<?php


namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
class UserToIDTransformer  implements DataTransformerInterface
{
// ...
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param  User|null $issue
     * @return string
     */
    public function transform($issue)
    {
        if (null === $issue) {
            return '';
        }

        return $issue->getId();
    }

    public function reverseTransform($issueNumber)
    {
        // ...
        // no issue number? It's optional, so that's ok
        if (!$issueNumber) {
            return;
        }

        $issue = $this->entityManager
            ->getRepository(User::class)
            // query for the issue with this id
            ->find($issueNumber)
        ;

        if (null === $issue) {
            $privateErrorMessage = sprintf('An issue with number "%s" does not exist!', $issueNumber);
            $publicErrorMessage = 'The given "{{ value }}" value is not a valid issue number.';

            $failure = new TransformationFailedException($privateErrorMessage);
            $failure->setInvalidMessage($publicErrorMessage, [
                '{{ value }}' => $issueNumber,
            ]);

            throw $failure;
        }

        return $issue;
    }


}
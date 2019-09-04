<?php

namespace App\Service;


use App\Entity\Ads\Ad;
use App\Entity\User;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;

class SerializerManager
{
    public function get(): Serializer
    {
        $encoder = new JsonEncoder();

        //------------------

        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getParent();
            },
        ];
        $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);
        /*$callback = function ($dateTime) {
            return $dateTime instanceof \DateTime
                ? $dateTime->format('Y-m-d H:i:s')
                : '';
        };

        $normalizer->setCircularReferenceHandler(function ($object) {
            if ($object instanceof \App\Entity\User\User) {
                return [
                    'id' => $object->getId(),
                    'email' => $object->getEmail(),
                    'username' => $object->getUsername(),
                ];
            } else {
                return $object->getId();
            }
        });
        $normalizer->setCallbacks(array('createdAt' => $callback, 'lastActivityAt' => $callback, 'updatedAt' => $callback, 'timestamp' => $callback, 'datetime' => $callback));
        $normalizer->setCircularReferenceLimit(2);*/
        return new Serializer([$normalizer], [new JsonEncoder()]);
    }
}
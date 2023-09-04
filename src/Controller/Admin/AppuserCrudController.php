<?php

namespace App\Controller\Admin;

use App\Entity\Appuser;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppuserCrudController extends AbstractCrudController
{
    private $passwordHasher;
    public function __construct(UserPasswordHasherInterface $uphi)
    {
        $this->passwordHasher = $uphi;
    }

    public static function getEntityFqcn(): string
    {
        return Appuser::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $actions
            // ->remove(Crud::PAGE_INDEX, Action::DELETE)
        ;
        return $actions;
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $plainPassword = $entityInstance->getPassword();
        $hashedPassword = $this->passwordHasher->hashPassword($entityInstance,$plainPassword);
        // dump($entityInstance); exit;
        $entityInstance
            ->setPassword($hashedPassword);
        ;
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $plainPassword = $entityInstance->getPassword();
        $hashedPassword = $this->passwordHasher->hashPassword($entityInstance,$plainPassword);
        dump($entityInstance->getRoles());
        $entityInstance->setRoles([$entityInstance->getRoles()]);
        // dump($entityInstance);
        // exit;
        $entityInstance
            ->setPassword($hashedPassword);
        ;
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }

    public function configureFields(string $pageName): iterable
    {
        $username = TextField::new('username');
        $password = TextField::new('password')->setFormType(PasswordType::class);
        $roles = ChoiceField::new('roles')
            ->setChoices(function(){
                return [
                    "ADMINISTRATOR" => "ROLE_ADMIN",
                    "MANAGER" => "ROLE_MANAGER",
                    // "LAB. TECHNICIAN" => "ROLE_LABTECH"
                ];
            })
            ->setLabel('User Roles')
            ->renderExpanded(true)
            ->allowMultipleChoices(true)
        ;
        if (Crud::PAGE_INDEX == $pageName) {
            return [$username];
        }
        return [
            $username,
            $password,
            $roles
        ];
    }
}

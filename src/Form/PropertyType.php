<?php

namespace App\Form;

use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('surface')
            ->add('rooms')
            ->add('bedrooms')
            ->add('floor')
            ->add('price')
            ->add('heat', ChoiceType::class, [
                'choices' => $this->getChoices()
            ]) #l'ajout de choiceType permet de rendre un champ select;  'choices' => Property::HEAT: affiche la cle et non la valeur; $this->getChoices():retourne la valeur equivalent a la clé
            ->add('city')
            ->add('address')
            ->add('postal_code')
            ->add('sold')
           # ->add('created_at') mettre ce champs en commentaire permet de refuser à l'utilisateur d'entrer lui même la date du jour

        ;
    }
#configureOptions permet de definir les differentes options du formulaire de manière globale
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
            #la ligne suivante permet dopérer les changements sur les champs du formulaire
            'translation_domain' => 'forms'
        ]);
    }

    private function getChoices()
    {
       $choices = Property::HEAT; #recupere tout les options de la constante
        $output = [];
        #cette boucle retourne une valeur par rapport aux clés
        foreach ($choices as $k => $v){
           $output[$v] = $k;
        }
        return $output;
    }
}

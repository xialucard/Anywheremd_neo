<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $page = 15;
    public $defaultPassword = "r00tb33r";
    public $newUserMsg = "For enhanced security, the new version of AnywhereMD requires you to re-submit your details and change your old password.";
    public $notApproveMsg = "User still not approved. Approval usually takes 24 hours. Please try again by that time.";


    public $docSpecs = array(
        "Internal Medicine"=>array(
                " ",
                "Cardiology",
                "Endocrinology",
                "Neurosurgery",
                "Gastroenterology",
                "Geriatics",
                "Hematology",
                "Immunology",
                "Infectious Diseases",
                "Medical Oncology",
                "Nephrology",
                "Pulmonology",
                "Rheumatology",
                "Allergology"
            ), 
        "Surgery"=>array(
                " ",
                "General Surgery",
                "Cardiothoracic Surgery",
                "Neurosurgery",
                "Pediatric Surgery",
                "Plastic, Reconstructive and Aesthetic Surgery",
                "Urology",
                "Vascular Surgery",
                "Head and Neck Surgery",
                "Gastrointestinal and Liver Surgery",
                "Onco-surgery"
            ), 
        "Ophthalmology"=>array(
                " ",
                "Comprehensive Ophthalmology",
                "Cataract and Refractive",
                "Cornea and Anterior Segment",
                "Glaucoma",
                "Retina and Vitreous",
                "Uveitis",
                "Pedia Ophthalmology or Strabismus",
                "Oculoplastic or Orbit",
                "Neuro Ophthalmology",
                "Ophthalmic Oncology"
            ), 
        "Otorhinolaryngology (ENT)"=>array(
                " ",
                "Oral and Maxillofacial Surgery",
                "Head and Neck Surgery",
                "Ear Microsurgery"
            ), 
        "Arthritis Clinic"=>array(), 
        "Orthopedics"=>array(
                " ",
                "General Orthopedics",
                "Pediatric Orthopedics",
                "Spine Surgery",
                "Hand Surgery"
            ),
        "Obstetrics and Gynecology"=>array(
                " ",
                "Gynecology Oncology",
                "Family Planning",
                "Obstetric and Gynecologic Infectious Diseases",
                "Reproductive Endocrinology and Infertility",
                "Trophoblastic Diseases",
                "Urogynecology, Pelvic Reconstructive Surgery",
                "Maternal and Fetal Medicine",
                "Obstetric and Gynecology Ultrasound"
            ), 
        "Pediatrics"=>array(
                " ",
                "General Pediatrics",
                "Neonatology",
                "Cardiology",
                "Pulmonology",
                "Rheumatology",
                "Nephrology",
                "Oncology/Hematology",
                "Infectious Diseases",
                "Emergency Medicine and Critical Care Developmental",
                "Developmental Pediatrics"
            ), 
        "Psychology"=>array(),
        "Dermatology"=>array(
                " ",
                "Blistering Disease Clinic",
                "Multidisciplinary Cutaneous Lymphoma Clinic",
                "Mohs and Dermatologic Surgery",
                "Dermatopathology",
                "Laser and Aesthetic Dermatology Clinic",
                "Pediatric Dermatology",
                "Pigmented Lesion and Melanoma Clinic",
                "Autoimmune Skin Disease Clinic",
                "Supportive Dermato-Oncology",
                "Skin Cancer Genetics Clinic",
                "High Risk Non Melanoma Skin Cancer Clinic",
                "Nail Disorders Clinic",
                "Hair Loss Clinic",
                "Genital Dermatology Clinic",
                "Advance Basal Cell Carcinoma Clinic",
                "Skin Allergies and Contact Dermatitis Clinic"
            ),
        "Psychiatry"=>array(
                " ",
                "Clinical Neurophysiology",
                "Forensic Psychiatry",
                "Addiction Psychiatry",
                "Child and Adolescent Psychiatry",
                "Geriatric Psychiatry",
                "Hospice and Palliative Medicine",
                "Pain Management",
                "Psychosomatic Medicine",
                "Sleep Medicine",
                "Brain Injury Medicine",
                "Cross-cultural Psychiatry",
                "Emergency Psychiatry",
                "Learning Disability",
                "Neurodevelopmental Disorder",
                "Cognition",
                "Biological Psychiatry",
                "Community Psychiatry",
                "Global Mental Health",
                "Military Psychiatry",
                "Sports Psychiatry"
            ),
        "General Medicine"=>array(),
        "Dental Medicine"=>array(),
        "Anesthesiology"=>array(),
        "Pain Management"=>array(),
        "Radiology"=>array(),
        "Rehabilitation Medicine"=>array(),
        "Neurology & Psychiatry"=>array(),
        "Urology"=>array(),
        "Family Medicine"=>array(),
        "POD"=>array()
        
    );

    public $civilStatus = array(
        "Single",
        "Married",
        "Widower",
        "Separated"
    );
    
    public function moduleList()
    {
        $moduleArr['Dashboard'] = array('link' => '/');
        $moduleArr["Patient's Records"] = array('link' => '/patient_records');
        $moduleArr['Setup'] = array(
                'sub' => array(
                        'Clinics' => array('link' => 'clinics.index'),
                        'Doctors' => array('link' => 'doctors.index'),
                        'Roles' => array('link' => 'roles.index'),
                        'Users' => array('link' => 'users.index'),
                    )
            );
        
        return $moduleArr;
    }

}

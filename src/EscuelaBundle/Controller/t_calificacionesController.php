<?php

namespace EscuelaBundle\Controller;

use EscuelaBundle\Entity\t_calificaciones;
use EscuelaBundle\Entity\t_alumnos;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
date_default_timezone_set("America/Mexico_City");
/**
 * T_calificacione controller.
 *
 */
class t_calificacionesController extends Controller
{

    /**
     * Servicio RESTful
     *
     */

    public function getAlumnos($request,$em){
        $alumno = $em->getRepository('EscuelaBundle:t_alumnos')->findAlumno($request);
        return $alumno;
    }

    public function getMaterias($request,$em){
        $materia = $em->getRepository('EscuelaBundle:t_materias')->findMateria($request);
        return $materia;
    }

    public function validateData($request,$alumno){
        if (!isset($request) && !isset($alumno)) {
            return array(
            'succes'=>'error',
            'msg'=>'No se recibieron datos'
            );  
        }elseif ($alumno && $request->get('materia') && $request->getMethod() == 'DELETE') {
            return null;
        }elseif ($alumno && $request->get('materia') && $request->get('calificacion') && $request->getMethod() == 'POST'){
            $em = $this->getDoctrine()->getManager();
            $findData = $em->getRepository('EscuelaBundle:t_calificaciones')->findOneBy(array('alumnos'=>$alumno,'materias'=>$request->get('materia')));
            if ($findData == null) {
                return null;
            }else{
                return array(
                'succes'=>'error',
                'msg'=>'Ya se le asigno una calificacion a este alumno ('.$findData->getAlumnos().' '.$findData->getAlumnos()->getAppaterno().' : '.$findData->getMaterias().' '.$findData->getCalificacion().')'
                );  
            }
        }elseif ($alumno && $request->get('materia') && $request->get('calificacion') && $request->getMethod() == 'PUT'){
            return null;
        }elseif ($alumno && $request->get('materia') == null && $request->get('calificacion') == null ){
            return array(
            'succes'=>'error',
            'msg'=>'No se recibio materia ni calificacion'
            );  
        }elseif (isset($alumno) && $request->get('materia') && $request->get('calificacion') == null  ) {
            return array(
            'succes'=>'error',
            'msg'=>'No se recibio calificacion'
            );  
        }elseif (isset($alumno) && $request->get('calificacion') && $request->get('materia') == null){
            return array(
            'succes'=>'error',
            'msg'=>'No se recibio materia'
            );  
        }
    }

    /**
     * Creates a new t_calificacione entity.
     *
     */
    public function newAction(Request $request, t_alumnos $t_alumno)
    {
        $t_calificacion = new T_calificaciones();
        $em = $this->getDoctrine()->getManager();
        $alumno = $this->getAlumnos($t_alumno,$em);
        $materia = $this->getMaterias($request->get('materia'),$em);
        $calificacion= $request->get('calificacion');

        $validateData=$this->validateData($request,$t_alumno);

        if ($validateData == null) {

            foreach ($alumno as $Nalumno) {
                $t_calificacion->setAlumnos($Nalumno);
            }            
            foreach ($materia as $Nmateria) {
                $t_calificacion->setMaterias($Nmateria);
            }
            $t_calificacion->setCalificacion($calificacion);
            $t_calificacion->setFechaRegistro(new \DateTime('now'));

            $em->persist($t_calificacion);
            $complete= $em->flush();

            if ($complete == null) {
                $succes = 'ok';
                $msg = 'calificacion registrada';
            }
        }else{
            $succes=$validateData['succes'];
            $msg=$validateData['msg'];
        }

        $result= array(
            'succes'=>$succes,
            'msg'=>$msg
        );

        return $this->json($result);
    }

    /**
     * Finds and displays a t_calificacione entity.
     *
     */
    public function showAction(t_alumnos $t_alumno)
    {
        $em = $this->getDoctrine()->getManager();
        $calificaciones = $em->getRepository('EscuelaBundle:t_calificaciones')->findBy(array('alumnos'=>$this->getAlumnos($t_alumno,$em)));
            foreach ($calificaciones as $calificacion) {
                $result[]= array(
                'id_t_usuario'=>$calificacion->getAlumnos()->getID(),
                'nombre'=>$calificacion->getAlumnos()->getNombre(),
                'apellido'=>$calificacion->getAlumnos()->getAppaterno(),
                'materia'=>$calificacion->getMaterias()->getNombre(),
                'calificacion'=>$calificacion->getCalificacion(),
                'fecha_registro'=>date_format($calificacion->getFechaRegistro(),'d/m/Y'),
                );
                $promedio[]=$calificacion->getCalificacion();
            }
        $result[]=array('promedio'=>(array_sum($promedio)/count($promedio)));
        return $this->json($result);
    }

    /**
     * Displays a form to edit an existing t_calificacione entity.
     *
     */
    public function editAction(Request $request, t_alumnos $t_alumno)
    {
        $em = $this->getDoctrine()->getManager();
        
        $validateData=$this->validateData($request,$t_alumno);

        if ($validateData == null) {
            $alumno = $this->getAlumnos($t_alumno,$em);
            $materia = $this->getMaterias($request->get('materia'),$em);        
            $upCalificacion=$em->getRepository('EscuelaBundle:t_calificaciones')->findCalificacion($alumno,$materia);
            $calificacion= $request->get('calificacion');
            foreach ($upCalificacion as $updatecalificacion) {
                $updatecalificacion->setCalificacion($calificacion);
                $updatecalificacion->setFechaRegistro(new \DateTime('now'));
            }

            $em->persist($updatecalificacion);
            $complete= $em->flush();

            if ($complete == null) {
                $succes='OK';
                $msg='calificion actualizada';
            }
        }else{
            $succes=$validateData['succes'];
            $msg=$validateData['msg'];
        }                   

        $result= array(
            'succes'=>$succes,
            'msg'=>$msg
        );     

        return $this->json($result);
    
    }

    /**
     * Deletes a t_calificacione entity.
     *
     */
    public function deleteAction(Request $request, t_alumnos $t_alumno)
    {
        $em = $this->getDoctrine()->getManager();
        
        $validateData=$this->validateData($request,$t_alumno);

        if ($validateData == null) {
            $alumno = $this->getAlumnos($t_alumno,$em);
            $materia = $this->getMaterias($request->get('materia'),$em);
            
            $upCalificacion=$em->getRepository('EscuelaBundle:t_calificaciones')->findCalificacion($alumno,$materia);

            foreach ($upCalificacion as $updatecalificacion) {
                $em->remove($updatecalificacion);
            }

            $complete= $em->flush();

            if ($complete == null) {
                $succes = 'ok';
                $msg = 'calificacion eliminada';
            }

        }else{
            $succes=$validateData['succes'];
            $msg=$validateData['msg'];
        }  

        $result= array(
            'succes'=>$succes,
            'msg'=>$msg
        );

        return $this->json($result);
    }

}

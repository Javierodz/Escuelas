<?php

namespace EscuelaBundle\Entity;

/**
 * t_calificaciones
 */
class t_calificaciones
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $calificacion;

    /**
     * @var \DateTime
     */
    private $fechaRegistro;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set calificacion
     *
     * @param string $calificacion
     *
     * @return t_calificaciones
     */
    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;

        return $this;
    }

    /**
     * Get calificacion
     *
     * @return string
     */
    public function getCalificacion()
    {
        return $this->calificacion;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     *
     * @return t_calificaciones
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }
    /**
     * @var \EscuelaBundle\Entity\t_alumnos
     */
    private $alumnos;

    /**
     * @var \EscuelaBundle\Entity\t_materias
     */
    private $materias;


    /**
     * Set alumnos
     *
     * @param \EscuelaBundle\Entity\t_alumnos $alumnos
     *
     * @return t_calificaciones
     */
    public function setAlumnos(\EscuelaBundle\Entity\t_alumnos $alumnos = null)
    {
        $this->alumnos = $alumnos;

        return $this;
    }

    /**
     * Get alumnos
     *
     * @return \EscuelaBundle\Entity\t_alumnos
     */
    public function getAlumnos()
    {
        return $this->alumnos;
    }

    /**
     * Set materias
     *
     * @param \EscuelaBundle\Entity\t_materias $materias
     *
     * @return t_calificaciones
     */
    public function setMaterias(\EscuelaBundle\Entity\t_materias $materias = null)
    {
        $this->materias = $materias;

        return $this;
    }

    /**
     * Get materias
     *
     * @return \EscuelaBundle\Entity\t_materias
     */
    public function getMaterias()
    {
        return $this->materias;
    }
}

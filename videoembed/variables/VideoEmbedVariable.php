<?php
namespace Craft;

class VideoEmbedVariable
{

    const KEY_YOUTUBE = 'youtube';
    const KEY_VIMEO = 'vimeo';
    const KEY_NULLED = NULL;

	/**
	 * Take a youtube or vimeo url and return the embed url
	 *
	 * @param string $url
	 * @return string
	 */
	public function getEmbedUrl($url)
	{
		if ($this->_isYoutube($url)) {
			$url_parts = parse_url($url);
			parse_str($url_parts['query'], $segments);

			return '//www.youtube.com/embed/' . $segments['v'];
		} else if ($this->_isVimeo($url)) {
			$url_parts = parse_url($url);
			$segments = explode('/', $url_parts['path']);

			return '//player.vimeo.com/video/' . $segments[1] . '?player_id=video&api=1';
		}
	}


	/**
	 * Determine whether the url is a youtube or vimeo url
	 * @param string $url
	 * @return boolean
	 */
	public function isVideoUrl($url)
	{
		return ($this->_isYoutube($url) || $this->_isVimeo($url));
	}

    /**
     * Determines and returns video provider
     * @param $url
     * @return null|string
     */
    public function getVideoProvider($url)
    {
        switch($url) {
            case ($this->_isYoutube($url)):
                return self::KEY_YOUTUBE;
                break;

            case ($this->_isVimeo($url)):
                return self::KEY_VIMEO;
                break;

            default:
                return self::KEY_NULLED;
        }
	}

	/**
	 * Is the url a youtube url
	 * @param string $url
	 * @return boolean
	 */
	private function _isYoutube($url)
	{
		return strripos($url, 'youtube.com') !== FALSE;
	}


	/**
	 * Is the url a vimeo url
	 * @param string $url
	 * @return boolean
	 */
	private function _isVimeo($url)
	{
		return strripos($url, 'vimeo.com') !== FALSE;
	}
}